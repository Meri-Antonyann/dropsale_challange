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
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumns('users', ['first_name', 'last_name', 'age'])){
                $table->renameColumn('name', 'first_name');
                $table->string('last_name');
                $table->integer('age');
            }
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumns('users', ['first_name', 'last_name', 'age'])){
                $table->renameColumn('first_name', 'name');
                $table->dropColumn('last_name');
                $table->dropColumn('age');
            }
        });
    }
};
