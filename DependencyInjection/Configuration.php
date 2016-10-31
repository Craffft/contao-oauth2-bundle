<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('craffft_contao_oauth2');

        $rootNode
            ->children()
                ->booleanNode('extend_member')
                    ->defaultFalse()
                ->end()
                ->scalarNode('member_entity')
                    ->defaultValue('Craffft\ContaoOAuth2Bundle\Entity\Member')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('member_repository')
                    ->defaultValue('Craffft\ContaoOAuth2Bundle\Repository\MemberRepository')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
