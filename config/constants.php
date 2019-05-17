<?php

return [
    'popular_article_rank'  => 5, //最多被访问的文章的数
    'threads_per_page' => 5,//一页显示多少thread
    'replis_per_page' => 5,//一页显示多少回帖
    'profile_expire_minute' => 5,//个人信息在线统计有效期分钟,cache用
    'guest_expire_minute' => 1440,//游客在线统计有效期分钟，一个IP一天统计一次
    'thread_bodylen' => 6000,//thread body 长度
    'thread_titlelen' => 200,//thread title length
    'expire_minute' => 30, //在线时间单位分钟

    'items_per_part' => 2,//当一个分区只看一个内容，显示多少内容
    'index_per_page' => 5,//当只搜索目录信息的时候，一页显示多少项目
    'index_per_part' => 2,//当index用于整合页面的时候，一个分区显示多少项目
    'update_min' => 1000, //章节更新必须达到这个水平才能进入排名榜
    'longcomment_length' => 200, //“长评”必须达到该字数
    'default_user_group' => 10,
    'default_majia' => '匿名咸鱼',

    'collection_type_info' => [
        1 => '书籍收藏单',
        2 => '讨论贴收藏单',
        3 => '回帖收藏单',
        4 => '收藏单的收藏单',
        5 => '自己建立的收藏单',
        6 => '所有的收藏单'
    ],

    'vote_info' => [
        'item_types' => [
            'post' => 1,
            'thread' =>2,
        ],
        'attitude_types' => [
            'upvote' => 1,
            'downvote' => 2,
            'funny' => 3,
            'fold' => 4,
        ],
    ],


];
