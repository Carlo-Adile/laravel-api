<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'cover_image', 'type_id'];

    /* relazione one to many (un progetto appartiene a un type, un type può avere molti progetti) */
    /**
     * Get the type that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /* relazione many to many (i progetti hanno molte tecnologie; le tecnologie appartengono a molti progetti) */
    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Technology::class);
    }
}
