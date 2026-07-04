<?php

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
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'bank_provider')) {
                $table->string('bank_provider', 100)->nullable()->after('amount');
            }
            if (!Schema::hasColumn('payments', 'bank_account_name')) {
                $table->string('bank_account_name', 100)->nullable()->after('bank_provider');
            }
            if (!Schema::hasColumn('payments', 'bank_account_number')) {
                $table->string('bank_account_number', 20)->nullable()->after('bank_account_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'bank_account_number')) {
                $table->dropColumn('bank_account_number');
            }
            if (Schema::hasColumn('payments', 'bank_account_name')) {
                $table->dropColumn('bank_account_name');
            }
            if (Schema::hasColumn('payments', 'bank_provider')) {
                $table->dropColumn('bank_provider');
            }
        });
    }
};
