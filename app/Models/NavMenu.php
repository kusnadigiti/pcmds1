<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'parent_id',
        'order',
        'is_visible',
        'open_new_tab',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'open_new_tab' => 'boolean',
    ];

    // Relasi: anak dari menu ini
    public function children()
    {
        return $this->hasMany(NavMenu::class, 'parent_id')->orderBy('order');
    }

    // Relasi: parent dari sub-item ini
    public function parent()
    {
        return $this->belongsTo(NavMenu::class, 'parent_id');
    }

    // Scope: hanya menu level atas
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('order');
    }

    // Scope: hanya yang visible
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    // Helper: apakah punya sub-item
    public function isDropdown(): bool
    {
        return $this->children()->exists();
    }

    // Helper: apakah menu ini adalah parent (tidak punya URL sendiri)
    public function isParentOnly(): bool
    {
        return empty($this->url);
    }
}
