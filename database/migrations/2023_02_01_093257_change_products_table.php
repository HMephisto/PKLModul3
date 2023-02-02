<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE products ALTER COLUMN 
                brand TYPE BIGINT USING (brand)::BIGINT');

        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger("brand")->nullable()->change();
            $table->renameColumn('brand', 'brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->renameColumn('brand_id', 'brand');
        });
     
        DB::statement('ALTER TABLE products ALTER COLUMN 
                brand TYPE VARCHAR USING (brand)::VARCHAR');
    }
};
