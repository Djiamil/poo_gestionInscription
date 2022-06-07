<?php

namespace App\Entity;

use App\Repository\HtmlproviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HtmlproviderRepository::class)]
class Htmlprovider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    public static function navInfo(string $text="vue",string $color="dark",int $textsize=6,string $textbtn = "button",string $btncolor="primary",string $link="#")
{
    echo "<nav class='container bg-$color p-3'>
    <span class='display-$textsize text-white mt-2'>$text</span>
    <a class='mt-2 text-white float-end btn btn-sm btn-$btncolor' href='$link'>$textbtn</a>
    </nav>";
}
}
