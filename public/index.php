<?php

require __dir__ . '/../vendor/autoload.php';

$entityManager = \Cinema\Factory\EntityManager::factory();
$seatMapper = new \Cinema\SeatMapper($entityManager);

$cinema = $seatMapper->findCinemaById(1);
$seats = range(1, $cinema->getAmountOfSeats());

$chosenSeats = array_map(function (\Cinema\Model\Seat $seat) {
    return $seat->getNumber();
}, $cinema->getChosenSeats()->toArray());

$seatManager = new \Cinema\SeatManager($cinema->getAmountOfSeats(), $chosenSeats);
$selectedSeats = $seatManager->getSeatNumbers(5);
?>

<?php foreach ($seats as $seat): ?>
    <?php
    if (in_array($seat, $chosenSeats)):
        $color = '#E3410B';
    elseif (in_array($seat, $selectedSeats)):
        $color = '#0BADE3';
    else:
        $color = '#A1D490';
    endif;
    ?>

    <span style="padding: 10px; color: <?= $color ?>"><?= $seat ?></span>
<?php endforeach; ?>


