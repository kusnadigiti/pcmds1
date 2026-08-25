<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostPagesTest extends TestCase
{
    public function test_articles_index_page_returns_successful_response(): void
    {
        $response = $this->get('/articles/all');

        $response->assertStatus(200);
    }

    public function test_news_index_page_returns_successful_response(): void
    {
        $response = $this->get('/berita/show-all');

        $response->assertStatus(200);
    }
}
