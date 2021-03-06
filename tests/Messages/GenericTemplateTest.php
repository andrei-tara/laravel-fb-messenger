<?php

use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Messages\GenericTemplate;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:45
 */
class GenericTemplateTest extends TestCase
{
    private $sender;

    private $case;

    public function setUp()
    {
        $this->sender = str_random();
        $this->case = [
            new Element('title1', 'description1'),
            new Element('title2', 'description2')
        ];
    }

    public function test_to_data()
    {
        $elementExpected = [];
        foreach ($this->case as $case) {
            $elementExpected[] = $case->toData();
        }
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => $elementExpected
                    ],
                ]
            ],
        ];

        $actual = new GenericTemplate($this->sender, $this->case);

        $this->assertEquals($expected, $actual->toData());
    }
}
