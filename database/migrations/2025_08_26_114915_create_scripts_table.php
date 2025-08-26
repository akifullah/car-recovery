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
        Schema::create('scripts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Script name
            $table->enum('scope', ['entire_website', 'single_page']); // where script applies
            $table->enum('position', ['head', 'body']); // where script should be placed
            $table->longText('code'); // script code or link
            $table->json('page')->nullable(); // if single page selected, store as JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scripts');
    }
};
