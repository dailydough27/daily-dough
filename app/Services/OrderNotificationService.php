<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderNotificationService
{
    public function sendEmail(Order $order): void
    {
        $apiKey = env('RESEND_API_KEY');
        $to = env('ORDER_NOTIFICATION_EMAIL', 'dailydough27@gmail.com');
        $from = env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev');
        $fromName = env('MAIL_FROM_NAME', 'Daily Dough');

        if (!$apiKey) {
            Log::warning('Daily Dough order email skipped: RESEND_API_KEY is not configured.', [
                'order_number' => $order->order_number,
            ]);
            return;
        }

        $order->loadMissing('items');
        $html = $this->buildHtml($order);

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->post('https://api.resend.com/emails', [
                    'from' => sprintf('%s <%s>', $fromName, $from),
                    'to' => [$to],
                    'subject' => 'New Daily Dough Order #' . $order->order_number,
                    'html' => $html,
                ]);

            if ($response->failed()) {
                Log::error('Daily Dough order email failed.', [
                    'order_number' => $order->order_number,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Daily Dough order email exception.', [
                'order_number' => $order->order_number,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function buildHtml(Order $order): string
    {
        $e = fn ($value) => e((string) ($value ?? '—'));
        $money = fn ($value) => number_format((float) $value, 2) . ' EGP';

        $items = '';
        foreach ($order->items as $item) {
            $selection = $item->selection;
            if (is_array($selection) && $selection !== []) {
                $selectionText = e(json_encode($selection, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            } else {
                $selectionText = '—';
            }

            $items .= '<tr>'
                . '<td style="padding:10px;border-bottom:1px solid #eadfce;">'
                . '<strong>' . $e($item->box_size ?: 'Product') . '</strong>'
                . '<div style="font-size:12px;color:#6f6255;margin-top:4px;">Selection: ' . $selectionText . '</div>'
                . '</td>'
                . '<td style="padding:10px;border-bottom:1px solid #eadfce;text-align:center;">' . $e($item->quantity) . '</td>'
                . '<td style="padding:10px;border-bottom:1px solid #eadfce;text-align:right;">' . $money($item->subtotal) . '</td>'
                . '</tr>';
        }

        return '<!doctype html><html><body style="margin:0;background:#f7f0e7;font-family:Arial,sans-serif;color:#3f3027;">'
            . '<div style="max-width:700px;margin:30px auto;background:#fffaf4;border:1px solid #eadfce;border-radius:18px;overflow:hidden;">'
            . '<div style="padding:24px 28px;background:#4a3025;color:#fffaf4;">'
            . '<div style="font-size:26px;font-weight:700;">Daily Dough</div>'
            . '<div style="margin-top:6px;opacity:.85;">New order received</div>'
            . '</div>'
            . '<div style="padding:28px;">'
            . '<h2 style="margin-top:0;">Order #' . $e($order->order_number) . '</h2>'
            . '<h3>Customer</h3>'
            . '<p style="line-height:1.7;margin-bottom:22px;">'
            . '<strong>Name:</strong> ' . $e($order->customer_name) . '<br>'
            . '<strong>Phone:</strong> ' . $e($order->phone) . '<br>'
            . '<strong>Area:</strong> ' . $e($order->area) . '<br>'
            . '<strong>Address:</strong> ' . $e($order->address) . '<br>'
            . '<strong>Apartment:</strong> ' . $e($order->apartment) . '<br>'
            . '<strong>Notes:</strong> ' . $e($order->notes) . '</p>'
            . '<h3>Items</h3>'
            . '<table style="width:100%;border-collapse:collapse;background:#fff;">'
            . '<thead><tr style="background:#f1e5d7;"><th style="padding:10px;text-align:left;">Product</th><th style="padding:10px;">Qty</th><th style="padding:10px;text-align:right;">Subtotal</th></tr></thead>'
            . '<tbody>' . $items . '</tbody></table>'
            . '<div style="margin-top:22px;padding:18px;background:#f1e5d7;border-radius:12px;line-height:1.9;">'
            . '<strong>Subtotal:</strong> ' . $money($order->subtotal) . '<br>'
            . '<strong>Delivery:</strong> ' . $money($order->delivery_fee) . '<br>'
            . '<strong>Discount:</strong> ' . $money($order->discount) . '<br>'
            . '<strong style="font-size:18px;">Total: ' . $money($order->total) . '</strong><br>'
            . '<strong>Payment:</strong> ' . $e(strtoupper($order->payment_method))
            . '</div></div></div></body></html>';
    }
}
