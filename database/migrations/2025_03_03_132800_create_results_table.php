
    <?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    return new class extends Migration {
        public function up(): void
        {
            Schema::create('results', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
                $table->decimal('score', 5, 2);
                $table->string('grade');
                $table->timestamps();
            });
        }
    
        public function down(): void
        {
            Schema::dropIfExists('results');
        }
    };
    
    

