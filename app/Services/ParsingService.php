<?php

namespace App\Services;

use Vedmant\FeedReader\Facades\FeedReader;
use App\Models\Post;

class ParsingService
{
    private $url = 'https://lifehacker.com/rss';

    public function insertFeeds(): void {
        foreach($this->getAllFeeds() as $value) {
            $image = $this->getImage($value->get_description());

            Post::create([
                'author' => $value->get_author()->name,
                'title' => $value->get_title(),
                'description' => $value->get_description(),
                'image' => end($image),
                'link' => $value->get_link(),
            ]);
        }
    }

    private function getAllFeeds(): array {
        return FeedReader::read($this->url)->get_items();
    }

    private function getImage(string $text): array {
        preg_match_all('@<img.*src="([^"]*)"[^>/]*/?>@Ui', $text, $out);
        return end($out);
    }
}
