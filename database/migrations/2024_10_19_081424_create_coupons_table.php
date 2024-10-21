<?php

use App\Enums\CopounState;
use App\Enums\CopounStatus;
use App\Enums\DiscountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('discount');
            $table->integer('discount_type')->default(DiscountType::VALUE);
            $table->nullableMorphs('couponable');
            $table->integer('times');
            $table->boolean('status')->default(CopounStatus::INACTIVE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copouns');
    }
};
