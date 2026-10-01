<script setup>
import { reactive, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import SiteHeader from '../Components/SiteHeader.vue';

const props = defineProps({ cart: Array, zones: Array, settings: Object, errors: Object });
const form = reactive({ customer_name:'', phone:'', area:'', address:'', apartment:'', notes:'', payment_method:'cod', delivery_zone_id:props.zones?.[0]?.id||'', coupon_code:'' });
const localErrors = reactive({});
const processing = reactive({ value:false });
const subtotal = computed(() => props.cart.reduce((a,b) => a + Number(b.subtotal), 0));
const zone = computed(() => props.zones.find(z => z.id === form.delivery_zone_id));
const delivery = computed(() => subtotal.value >= Number(props.settings?.free_delivery_threshold||500) ? 0 : Number(zone.value?.fee||0));
const total = computed(() => subtotal.value + delivery.value);
const errorFor = (field) => localErrors[field] || props.errors?.[field];

function validate() {
  Object.keys(localErrors).forEach(k => delete localErrors[k]);
  if (!form.customer_name.trim()) localErrors.customer_name = 'Please enter your full name.';
  if (!form.phone.trim()) localErrors.phone = 'Please enter your phone number.';
  else if (!/^[0-9+()\s-]{8,20}$/.test(form.phone.trim())) localErrors.phone = 'Please enter a valid phone number.';
  if (!form.delivery_zone_id) localErrors.delivery_zone_id = 'Please select a delivery zone.';
  if (!form.area.trim()) localErrors.area = 'Please enter your area / neighborhood.';
  if (!form.address.trim()) localErrors.address = 'Please enter your full address.';
  return Object.keys(localErrors).length === 0;
}

function submit() {
  if (!validate()) return;
  router.post('/checkout', form, {
    preserveScroll: true,
    onStart: () => processing.value = true,
    onFinish: () => processing.value = false,
  });
}
</script>

<template>
<SiteHeader/>
<main class="mx-auto grid max-w-5xl gap-10 px-5 py-14 lg:grid-cols-[1.2fr_.8fr]">
  <section>
    <p class="eyebrow">Checkout</p><h1 class="serif text-5xl font-bold">Almost there.</h1>
    <p class="mt-3 opacity-65">Cash on delivery for now. We’ll confirm your order with you.</p>
    <div class="mt-8 space-y-4">
      <div><input v-model="form.customer_name" placeholder="Full name *" class="field"><p v-if="errorFor('customer_name')" class="mt-1 text-sm text-red-700">{{errorFor('customer_name')}}</p></div>
      <div><input v-model="form.phone" placeholder="Phone number *" class="field"><p v-if="errorFor('phone')" class="mt-1 text-sm text-red-700">{{errorFor('phone')}}</p></div>
      <div><select v-model="form.delivery_zone_id" class="field"><option value="" disabled>Select delivery zone *</option><option v-for="z in zones" :key="z.id" :value="z.id">{{z.name}} · {{z.fee}} EGP delivery</option></select><p v-if="errorFor('delivery_zone_id')" class="mt-1 text-sm text-red-700">{{errorFor('delivery_zone_id')}}</p></div>
      <div><input v-model="form.area" placeholder="Area / neighborhood *" class="field"><p v-if="errorFor('area')" class="mt-1 text-sm text-red-700">{{errorFor('area')}}</p></div>
      <div><textarea v-model="form.address" placeholder="Full address *" rows="3" class="field"></textarea><p v-if="errorFor('address')" class="mt-1 text-sm text-red-700">{{errorFor('address')}}</p></div>
      <input v-model="form.apartment" placeholder="Apartment / building (optional)" class="field">
      <textarea v-model="form.notes" placeholder="Delivery notes (optional)" rows="2" class="field"></textarea>
      <div><input v-model="form.coupon_code" placeholder="Coupon code (optional)" class="field"><p v-if="errorFor('coupon_code')" class="mt-1 text-sm text-red-700">{{errorFor('coupon_code')}}</p></div>
    </div>
  </section>
  <aside class="card dark h-fit">
    <h2 class="serif text-3xl font-bold">Your order</h2>
    <div class="mt-6 space-y-4"><div v-for="line in cart" :key="line.id" class="flex justify-between gap-4 text-sm"><span>{{line.box_name}} × {{line.quantity}}</span><span>{{line.subtotal}} EGP</span></div></div>
    <div class="mt-7 border-t border-white/15 pt-5 text-sm"><div class="flex justify-between"><span>Subtotal</span><b>{{subtotal}} EGP</b></div><div class="mt-2 flex justify-between"><span>Delivery</span><b>{{delivery}} EGP</b></div><div class="mt-4 flex justify-between text-xl"><span>Total</span><b>{{total}} EGP</b></div></div>
    <button :disabled="processing.value" @click="submit" class="mt-7 w-full rounded-full bg-cream py-3 font-bold text-brown disabled:opacity-40">{{ processing.value ? 'Placing Order…' : 'Place Order · Cash on Delivery' }}</button>
  </aside>
</main>
</template>
