<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('password');
            $table->boolean('estado')->default(1)->after('foto');
            $table->dateTime('ultimo_login')->nullable()->after('estado');
            $table->string('roll')->nullable()->after('ultimo_login');
            $table->integer('id_sistema')->default(0)->after('roll');
        });
    }

    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'foto')) {
            $table->dropColumn('foto');
        }
        if (Schema::hasColumn('users', 'estado')) {
            $table->dropColumn('estado');
        }
        if (Schema::hasColumn('users', 'ultimo_login')) {
            $table->dropColumn('ultimo_login');
        }
        if (Schema::hasColumn('users', 'roll')) {
            $table->dropColumn('roll');
        }
        if (Schema::hasColumn('users', 'id_ppal')) {
            $table->dropColumn('id_ppal');
        }
    });
}

};