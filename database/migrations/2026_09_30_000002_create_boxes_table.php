<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('boxes',function(Blueprint $t){$t->id();$t->string('name');$t->unsignedInteger('size');$t->decimal('price',10,2);$t->boolean('is_active')->default(true);$t->timestamps();}); } public function down(): void { Schema::dropIfExists('boxes'); } };
