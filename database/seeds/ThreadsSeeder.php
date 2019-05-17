<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ThreadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('threads')->insert([
     'title' => 'The Wall Street Journal' ,
     'body' => 'The Wall Street Journal is a U.S. business-focused, English-language international daily harles Bergstresser',
     'foreword' => 'The Wall Street Journal is a U.S. business-focused...',
     'channel_id' => 4,
     'user_id' => '2',
     'visible_level' => 0,
     'can_comment' => 0,
     'created_at' => Carbon::now(),
     'updated_at'=> Carbon::now()
 ]);



 DB::table('threads')->insert([
    'title' => 'Un tsunami de défiance contre les élites' ,
    'body' => "La cote d'alerte est atteinte. Jamais les Français n'avaient exprimé une telle défiance dans les instances et les acteurs de la vie démocratique. Le président de la République - sa fonction et sa personne - est l'épicentre de ce séisme. Tous les indicateurs du baromètre de la confiance du Centre d'étude de la vie politique (Cevipof)" ,
    'foreword' => "La cote d'alerte est atteinte. Jamais les Français n'avaient..." ,
    'channel_id' => 4,
    'user_id' => '2',
    'visible_level' => 0,
    'can_comment' => 0,
    'created_at' => Carbon::now(),
    'updated_at'=> Carbon::now()
 ]);


 DB::table('threads')->insert([
    'title' => "警官36人、1年超毎月現金　試験問題集執筆料",
    'body' => " 警察庁と17道府県の警察官が、昇任試験の対策問題集を出版する「EDU－COM」（東京）から原稿執筆料を受け取っていた問題で、12カ月以上、毎月執筆料が支払われていた警察官が少なくとも36人いることが、同社作成の支払いリストで明らかになった。このうち1500万円超を受け取ったとされる大阪府警の警視正には4年10カ月にわたって毎月支払われ、月の最高額は約137万円に達していた。いずれも副業許可を受けておらず、地方公務員法（兼業の禁止）違反などに当たる可能性が高い。(西日本新聞)",
    'foreword' => "警察庁と17道府県の警察官が、昇任試験の対策問題集を出版する「EDU－COM」" ,
    'channel_id' => 4,
    'user_id' => '2',
    'visible_level' => 0,
    'can_comment' => 0,
    'created_at' => Carbon::now(),
    'updated_at'=> Carbon::now()
 ]);


 DB::table('threads')->insert([
    'title' => "解放了的普罗米修斯--是英国浪漫主义诗人雪莱的诗剧" ,
    'body' => "普罗米修斯是提坦巨神伊阿珀托斯和大河女神克吕墨涅所生的儿子。他智慧和胆识过人，能未卜先知，所以他的名字便有预见的意思。他曾帮助朱比特（即宙斯）夺得了天帝的宝座，推翻了撒旦的统治。但朱比特上台后，违背了自己的诺言，企图毁灭人类。普罗米修斯从天庭把火偷给了人类，使人间有了火种；他又传授各种技艺知识，使人间有了文化。朱比特得悉后，大发雷霆，他把普罗米修斯钉锁在高加索山崖上，白天派神鹰啄食他的肝脏，晚上他的肝脏又长出来，第二天神鹰复来啄食..这样循环往复，使普罗米修斯遭受无穷的痛苦 ",
    'foreword' =>  "普罗米修斯是提坦巨神伊阿珀托斯和大河女神克吕墨涅所生的儿子..." ,
    'channel_id' => 4,
    'user_id' => '2',
    'visible_level' => 0,
    'can_comment' => 0,
    'created_at' => Carbon::now(),
    'updated_at'=> Carbon::now()
 ]);


    }
}
