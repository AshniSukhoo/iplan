<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Iplan\Entity\AccountStatus;
use Iplan\Entity\User;
use Illuminate\Support\Facades\Mail;
use Iplan\Mail\VerifyAccountEmail;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that the registration works when correcty input is given.
     *
     * @return void
     */
    public function testRegistrationWithCorrectInputsRegistrationOK()
    {
        Mail::fake();
        
        $this->post('register', [
            'first_name'            => 'Ashni',
            'last_name'             => 'Sukhoo',
            'email'                 => 'ashni@email.com',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
        ]);
        
        $this->assertRedirectedTo('/login')
             ->seeInDatabase('users', [
                 'first_name'        => 'Ashni',
                 'last_name'         => 'Sukhoo',
                 'email'             => 'ashni@email.com',
                 'account_status_id' => AccountStatus::whereStatus('unconfirmed')->firstOrFail()->id,
             ]);
        
        $user_id = User::where('first_name', 'Ashni')->first()->id;
        $this->seeInDatabase('verification_tokens', [
            'user_id' => $user_id
        ]);
    
        Mail::assertSentTo(['ashni@email.com'], VerifyAccountEmail::class);
        
        $this->assertSessionHas('message.text', 'Your account has been created, we sent you an email to verify your account.');
    }
}
