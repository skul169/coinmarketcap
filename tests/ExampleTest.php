<?php

class ExampleTest extends TestCase {

    public function testInvest() {
        $user = factory('\App\User')->create();
        $this->actingAs($user)
                ->post('/member/receivedonate/setinvest', [
                    'quantity' => '3',
                    'tranaction_password'=>'12345678'
                ])
                ->see('You Invest Success');
    }

}
