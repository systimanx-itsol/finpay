<?php
namespace App\Models;

use Ramsey\Uuid\Uuid;
/**
 * Trait for auto creating uuid model
 */
trait Uuids
{
    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName()).
         */
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = $model->generateNewUuid();
            return true;
        });
    }
    /**
     * Get a new version 4 (random) UUID.
     *
     * @return \Rhumsaa\Uuid\Uuid
     */
    public function generateNewUuid()
    {
        return Uuid::uuid4()->toString();
    }
}


?>
