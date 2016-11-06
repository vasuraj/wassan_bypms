<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

    public function testadd()
    {
        $a=0;
        $b=5;
       // print_r(get_states());
        $this->assertEquals(5,$a+$b);

    }
	public function testBasicExample()
	{
		$response = $this->call('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
	}

}
