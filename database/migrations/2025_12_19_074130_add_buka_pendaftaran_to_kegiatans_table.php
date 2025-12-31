<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('kegiatans', function (Blueprint $table) {
        // Default true artinya: Biasanya dibuka pendaftarannya
        $table->boolean('buka_pendaftaran')->default(true)->after('deskripsi');
    });
}

public function down(): void
{
    Schema::table('kegiatans', function (Blueprint $table) {
        $table->dropColumn('buka_pendaftaran');
    });
}
};
