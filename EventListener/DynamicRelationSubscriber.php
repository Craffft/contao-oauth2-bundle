<?php

namespace Craffft\ContaoOAuth2Bundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;

class DynamicRelationSubscriber implements EventSubscriber
{
    /**
     * @var bool
     */
    private $extendMember;

    /**
     * @var string
     */
    private $memberRepository;

    /**
     * DynamicRelationSubscriber constructor.
     * @param bool $extendMember
     * @param string $memberEntity
     */
    public function __construct($extendMember, $memberRepository)
    {
        $this->extendMember = $extendMember;
        $this->memberRepository = $memberRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();

        if ($metadata->getName() !== 'Craffft\ContaoOAuth2Bundle\Entity\Member') {
            return;
        }

        /**
         * Move table to other name and remove all fields
         * if external bundle wants to extend the Member entity (tl_member)
         */
        if ($this->extendMember) {
            $metadata->setPrimaryTable(array(
                'name' => 'ignored_tl_member',
                'schema' => array(),
                'indexes' => array(),
                'uniqueConstraints' => array(),
                'options' => array()
            ));

            $metadata->fieldMappings = array(
                'id' => array(
                    'fieldName'  => 'id',
                    'type'       => 'integer',
                    'scale'      => 0,
                    'length'     => null,
                    'unique'     => false,
                    'nullable'   => false,
                    'precision'  => 0,
                    'options'    => array(
                        'unsigned' => true
                    ),
                    'id'         => true,
                    'columnName' => 'id'
                )
            );
        }

        if (strlen($this->memberRepository)) {
            $metadata->customRepositoryClassName = $this->memberRepository;
        }
    }
}
