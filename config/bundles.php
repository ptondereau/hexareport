<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Symplify\ConsoleColorDiff\ConsoleColorDiffBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Symplify\ParameterNameGuard\ParameterNameGuardBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Symplify\CodingStandard\SymplifyCodingStandardBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Symplify\EasyCodingStandard\EasyCodingStandardBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => [
        'all' => true,
    ],
];
