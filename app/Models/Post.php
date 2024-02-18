<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    use HasFactory;

    // eager loading, mesmo resultado que
    //utilizar o método with
    protected $with = ['category', 'author'];
    // Define o que pode não ser preenchido por mass assignment
    protected $guarded = ['id'];

    // QueryScope customizado
    // 1º where serve para agrupar entre parenteses o operador 'or'
    // (title LIKE %foo% OR body LIKE %bar%)
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query->where('slug', $category))

        );

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query->where('username', $author))
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Laravel assume que a foreign key é nome do método + id
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
