<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert(
            array(
                [
                    'title' => "Atlas Shrugged",
                    'alias' => "Atlas Shrugged",
                    'author' => "Ayn Rand",
                    'isbn' => '000001',
                    'intro' => "Atlas Shrugged is a 1957 novel by Ayn Rand. Rand's fourth and final novel, it was also her longest, and the one she considered to be her magnum opus in the realm of fiction writing. Atlas Shrugged includes elements of science fiction, mystery, and romance, and it contains Rand's most extensive statement of Objectivism in any of her works of fiction.",
                    'body' => "The books depicts a dystopian United States in which private businesses suffer under increasingly burdensome laws and regulations. Railroad executive Dagny Taggart and her lover, steel magnate Hank Rearden, struggle against looters who want to exploit their productivity. Dagny and Hank discover that a mysterious figure called John Galt is persuading other business leaders to abandon their companies and disappear as a strike of productive individuals against the looters. The novel ends with the strikers planning to build a new capitalist society based on Galt's philosophy of reason and individualism.
                               The theme of Atlas Shrugged, as Rand described it, is the role of man's mind in existence. The books explores a number of philosophical themes from which Rand would subsequently develop Objectivism. In doing so, it expresses the advocacy of reason, individualism, and capitalism, and depicts what Rand saw to be the failures of governmental coercion.
                               Atlas Shrugged received largely negative reviews after its 1957 publication, but achieved enduring popularity and consistent sales in the following decades."
                ],
                [
                    'title' => "The Fountainhead",
                    'alias' => "The Fountainhead",
                    'author' => "Ayn Rand",
                    'isbn' => '000002',
                    'intro' => "The Fountainhead is a 1943 novel by Russian-American author Ayn Rand, her first major literary success. The novel's protagonist, Howard Roark, is an individualistic young architect who designs modernist buildings and refuses to compromise with an architectural establishment unwilling to accept innovation. Roark embodies what Rand believed to be the ideal man, and his struggle reflects Rand's belief that individualism is superior to collectivism.",
                    'body' => "Roark is opposed by what he calls second-handers, who value conformity over independence and integrity. These include Roark's former classmate, Peter Keating, who succeeds by following popular styles, but turns to Roark for help with design problems. Ellsworth Toohey, a socialist architecture critic who uses his influence to promote his political and social agenda, tries to destroy Roark's career. Tabloid newspaper publisher Gail Wynand seeks to shape popular opinion; he befriends Roark, then betrays him when public opinion turns in a direction he cannot control. The novel's most controversial character is Roark's lover, Dominique Francon. She believes that non-conformity has no chance of winning, so she alternates between helping Roark and working to undermine him. Feminist critics have condemned Roark and Dominique's first sexual encounter, accusing Rand of endorsing rape.
                               Twelve publishers rejected the manuscript before an editor at the Bobbs-Merrill Company risked his job to get it published. Contemporary reviewers' opinions were polarized. Some praised the novel as a powerful paean to individualism, while others thought it overlong and lacking sympathetic characters. Initial sales were slow, but the books gained a following by word of mouth and became a bestseller. More than 6.5 million copies of The Fountainhead have been sold worldwide and it has been translated into more than 20 languages. The novel attracted a new following for Rand and has enjoyed a lasting influence, especially among architects, American conservatives and right-libertarians.
                               The novel has been adapted into other media several times. An illustrated version was syndicated in newspapers in 1945. Warner Bros. produced a film version in 1949; Rand wrote the screenplay, and Gary Cooper played Roark. Critics panned the film, which did not recoup its budget; several directors and writers have considered developing a new film adaptation. In 2014, Belgian theater director Ivo van Hove created a stage adaptation, which has received mostly positive reviews."
                ],
                [
                    'title' => "We the Living",
                    'alias' => "We the Living",
                    'author' => "Ayn Rand",
                    'isbn' => '000003',
                    'intro' => "We the Living is the debut novel of the Russian American novelist Ayn Rand.",
                    'body' => "It is a story of life in post-revolutionary Russia and was Rand's first statement against communism. Rand observes in the foreword that We the Living was the closest she would ever come to writing an autobiography. Rand finished writing the novel in 1934, but it was rejected by several publishers before being released by Macmillan Publishing in 1936. It has since sold more than three million copies."
                ]
            )
        );
    }
}
