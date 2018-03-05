<?php
use PHPUnit\Framework\TestCase;
use Pastebin\Request;

class RequestTest extends TestCase
{
  private $request;

  public function setUp() {
    $this->request = new Request(
      ['get_var_a' => 'Get Var A', 'get_var_b' => 'Get Var B'],
      ['post_var_a' => 'Post Var A', 'post_var_b' => 'Post Var B'],
      time()
    );
  }

  public function testGetsEmptyValuesAsNull()
  {
    $this->assertNull($this->request->get('not here'));
    $this->assertNull($this->request->post('not here either'));
  }

  public function testGetsValuesFromRequest()
  {
    $this->assertEquals('Get Var A', $this->request->get('get_var_a'));
    $this->assertEquals('Get Var B', $this->request->get('get_var_b'));
    $this->assertEquals('Post Var A', $this->request->post('post_var_a'));
    $this->assertEquals('Post Var B', $this->request->post('post_var_b'));
  }
}
