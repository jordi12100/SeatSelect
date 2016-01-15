<?php

/**
 * Example if loading from a database
 *
 * $chosenSeats = array_map(function (\Cinema\Model\Seat $seat) {
 *     return $seat->getNumber();
 * }, $cinema->getChosenSeats()->toArray());
 */

require __dir__ . '/../vendor/autoload.php';

$entityManager = \Cinema\Factory\EntityManager::factory();
$seatMapper = new \Cinema\SeatMapper($entityManager);

$visitors = isset($_GET['v']) ? (int)$_GET['v'] : 5;

$cinema = $seatMapper->findCinemaById(1);

$chosenSeats = range(1, $cinema->getAmountOfSeats());
shuffle($chosenSeats);

$percentageChosen = round($cinema->getAmountOfSeats() / 100 * 25);
$chosenSeats = array_slice($chosenSeats, 0, $percentageChosen);

$seatManager = new \Cinema\SeatManager($cinema->getAmountOfSeats(), $chosenSeats);
$selectedSeats = $seatManager->getSeatNumbers($visitors);
?>

<?php if ($selectedSeats === null):?>
    <p>Kon geen plaatsen vinden voor <?=$visitors?> bezoekers.</p>
<?php endif;?>

<?php exit;?>
<?php foreach (range(1, $cinema->getAmountOfSeats()) as $seat): ?>
    <?php
    if (in_array($seat, $chosenSeats)):
        $color = '#E3410B';
    elseif ($selectedSeats !== null && in_array($seat, $selectedSeats)):
        $color = '#0BADE3';
    else:
        $color = '#A1D490';
    endif;
    ?>

    <div style="width: 50px; height: 50px; border: 1px black solid; display:inline-block;">
        <span style="color: <?= $color ?>"><?= $seat ?></span>
    </div>

    <?=$seat % 10 === 0 ? '<br />' : ''?>
<?php endforeach; ?>
