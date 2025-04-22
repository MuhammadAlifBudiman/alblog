<?php

namespace App\Models;


class Post
{
    static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quidem odit, suscipit optio excepturi reprehenderit dolorum cumque similique, aperiam accusantium numquam blanditiis. Vitae aliquid laboriosam accusamus numquam quam exercitationem quas veniam laborum alias possimus iste odit autem, explicabo similique voluptatum est ab officiis quod eligendi ipsam fugit? Illo voluptatum numquam consectetur similique nisi molestias, quae, velit debitis deleniti facere quos delectus consequuntur, beatae laborum cupiditate nemo ullam ipsa praesentium perspiciatis corrupti. Aperiam fugit dignissimos veniam optio, molestiae quo velit consectetur?"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quidem odit, suscipit optio excepturi reprehenderit dolorum cumque similique, aperiam accusantium numquam blanditiis. Vitae aliquid laboriosam accusamus numquam quam exercitationem quas veniam laborum alias possimus iste odit autem, explicabo similique voluptatum est ab officiis quod eligendi ipsam fugit? Illo voluptatum numquam consectetur similique nisi molestias, quae, velit debitis deleniti facere quos delectus consequuntur, beatae laborum cupiditate nemo ullam ipsa praesentium perspiciatis corrupti. Aperiam fugit dignissimos veniam optio, molestiae quo velit consectetur?"
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
