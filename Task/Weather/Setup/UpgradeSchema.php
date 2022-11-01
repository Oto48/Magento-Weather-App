<?php
namespace Task\Weather\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('city_weather')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('city_weather')
                )
                    ->addColumn(
                        'weather_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Weather ID'
                    )
                    ->addColumn(
                        'city',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'City'
                    )
                    ->addColumn(
                        'country',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        225,
                        [],
                        'Country'
                    )
                    ->addColumn(
                        'description',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        225,
                        [],
                        'Description'
                    )
                    ->addColumn(
                        'temperature',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '11,4',
                        ['nullable => false'],
                        'Temperature'
                    )
                    ->addColumn(
                        'feels_like',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '11,4',
                        ['nullable => false'],
                        'Feels Like'
                    )
                    ->addColumn(
                        'pressure',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '11,4',
                        ['nullable => false'],
                        'Pressure'
                    )
                    ->addColumn(
                        'humidity',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '11,4',
                        ['nullable => false'],
                        'Humidity'
                    )
                    ->addColumn(
                        'wind_speed',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '11,4',
                        ['nullable => false'],
                        'Wind Speed'
                    )
                    ->addColumn(
                        'sunrise',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        225,
                        [],
                        'Sunrise'
                    )
                    ->addColumn(
                        'sunset',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        225,
                        [],
                        'Sunset'
                    )
                    ->addColumn(
                        'checked_on',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        225,
                        [],
                        'Checked On'
                    )

                    ->setComment('Customer Table');
                $installer->getConnection()->createTable($table);
                $installer->getConnection()->addIndex(
                    $installer->getTable('city_weather'),
                    $setup->getIdxName(
                        $installer->getTable('city_weather'),
                        ['weather_id','city','country','description','temperature','feels_like','pressure','humidity','wind_speed','sunrise','sunset'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['weather_id','city','country','description','temperature','feels_like','pressure','humidity','wind_speed','sunrise','sunset'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }
        $installer->endSetup();
    }
}
