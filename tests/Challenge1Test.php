<?php

use Interview\Challenge1\ImmutableWeekDay;
use PHPUnit\Framework\TestCase;

class Challenge1Test extends TestCase
{
    /**
     * @dataProvider invalidConstructorValues
     */
    public function test_throws_exception_for_initial_value(int $value): void
    {
        $this->expectException(\OutOfRangeException::class);
        new ImmutableWeekDay($value);
    }

    /**
     * @dataProvider properConstructorValues
     */
    public function test_properly_constructs_new_object(int $value): void
    {
        $this->assertIsObject(new ImmutableWeekDay($value));
    }

    public function test_days_are_equal(): void
    {
        $day1 = new ImmutableWeekDay(ImmutableWeekDay::FRIDAY);
        $day2 = new ImmutableWeekDay(ImmutableWeekDay::FRIDAY);

        $this->assertTrue($day1->equals($day2));
    }

    public function test_days_are_not_equal(): void
    {
        $day1 = new ImmutableWeekDay(ImmutableWeekDay::MONDAY);
        $day2 = new ImmutableWeekDay(ImmutableWeekDay::FRIDAY);

        $this->assertFalse($day1->equals($day2));
    }

    public function test_day_is_of_vlaue(): void
    {
        $day1 = new ImmutableWeekDay(ImmutableWeekDay::MONDAY);
        $this->assertTrue($day1->isOfValue(ImmutableWeekDay::MONDAY));
    }

    public function test_day_is_not_of_vlaue(): void
    {
        $day1 = new ImmutableWeekDay(ImmutableWeekDay::MONDAY);
        $this->assertFalse($day1->isOfValue(ImmutableWeekDay::THURSDAY));
        $this->assertFalse($day1->isOfValue(123));
    }

    /**
     * @dataProvider addDaysValues
     */
    public function test_adds_days_and_rotates_to_proper_week_day(int $daysToAdd, int $isOfValue, bool $isSameDay): void
    {
        $day1 = new ImmutableWeekDay(ImmutableWeekDay::SUNDAY);
        $day2 = $day1->addDays($daysToAdd);
        $this->assertTrue($day2->isOfValue($isOfValue), sprintf('Day 2 is not of value: %d', $isOfValue));

        if ($isSameDay) {
            $this->assertTrue($day1->equals($day2), 'Days are not the same even though they should be.');
        } else {
            $this->assertFalse($day1->equals($day2), 'Days are the same even though they should not.');
        }

        $this->assertFalse($day1 === $day2, 'Subjects refer to the same instance of an object which is not allowed for immutable objects.');
    }

    public function properConstructorValues(): array
    {
        return [
            [0],
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
        ];
    }

    public function invalidConstructorValues(): array
    {
        return [
            [-1],
            [7],
            [123],
        ];
    }

    public function addDaysValues(): array
    {
        return [
            [0, ImmutableWeekDay::SUNDAY, true],
            [1, ImmutableWeekDay::MONDAY, false],
            [7, ImmutableWeekDay::SUNDAY, true],
            [8, ImmutableWeekDay::MONDAY, false],
            [33, ImmutableWeekDay::FRIDAY, false],
        ];
    }
}