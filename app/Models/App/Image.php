<?php

namespace App\Models\App;

// Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

// Application
use App\Traits\StatusActiveTrait;
use App\Traits\StatusDeletedTrait;

class Image extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use StatusActiveTrait;
    use StatusDeletedTrait;

    protected $connection = 'pgsql-app';
    protected $table = 'app.images';

    protected $fillable = [
        'code',
        'name',
        'description',
        'uri',
        'extension',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public static function upload($model, $request)
    {
        $fileCode = Carbon::now();
        $filePath = $request->image->storeAs('images', $request->name . '.png', 'public');
        $image = $model->images()->where('name', $request->name)->first();
        if (!$image) {
            $avatar = new Image([
                'code' => $fileCode,
                'name' => $request->name,
                'description' => $request->description,
                'uri' => $filePath,
            ]);

            $avatar->imageable()->associate($model);
            $avatar->state()->associate(State::firstWhere('code', State::ACTIVE));
            $avatar->save();
        }

        return $image;

    }
}