<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('coupons', function(Blueprint $t){ $t->id(); $t->string('code')->unique(); $t->enum('type',['fixed','percent']); $t->decimal('value',10,2); $t->decimal('min_subtotal',10,2)->default(0); $t->boolean('is_active')->default(true); $t->timestamp('expires_at')->nullable(); $t->timestamps(); }); } public function down(): void { Schema::dropIfExists('coupons'); } };
