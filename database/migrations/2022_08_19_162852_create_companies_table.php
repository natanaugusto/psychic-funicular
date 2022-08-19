<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table:'companies', callback:static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model:User::class, column:'creator_id');
            $table->string(column:'name');
            $table->string(column:'doc_number', length:20)->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table:'companies');
    }
};
