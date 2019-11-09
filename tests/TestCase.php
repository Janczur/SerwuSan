<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Log in to the application with a given user or create a new one, log in with it and return it
     *
     * @param User|null $user
     * @return User
     */
    protected function signIn($user = null): User
    {
        $user = $user ?: factory(User::class)->create();

        $this->actingAs($user);

        return $user;
    }

    /**
     * Instancing UploadedFile object from test file in storage
     *
     * @return UploadedFile
     */
    protected function getTestFile(): UploadedFile
    {
        $filename = 'billing-test.csv';
        $path = storage_path('app/public/');
        return new UploadedFile($path.$filename, $filename, 'text/csv', null, true);
    }
}
