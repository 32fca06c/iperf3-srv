<?php
$path = 'iperf3.json';

$json = file_get_contents($path);
$data = json_decode($json, true);

if ($data && isset($data['intervals'])) {
    $intervals = $data['intervals'];
    ?>
    <table border="0">
        <thead>
            <tr>
                <th>Socket</th>
                <th>Start (s)</th>
                <th>End (s)</th>
                <th>Seconds (s)</th>
                <th>MBytes</th>
                <th>MBits per Second</th>
                <th>Omitted</th>
                <th>Sender</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($intervals as $interval) {
                foreach ($interval['streams'] as $stream) {
                    $socket = $stream['socket'];
                    $start = number_format($stream['start'], 2);
                    $end = number_format($stream['end'], 2);
                    $seconds = number_format($stream['seconds'], 0);
                    $mbytes = number_format($stream['bytes'] / (1024 * 1024), 2);
                    $mbits_per_second = number_format($stream['bits_per_second'] / 1000000, 2);
                    $omitted = $stream['omitted'] ? 'Yes' : 'No';
                    $sender = $stream['sender'] ? 'Yes' : 'No';
                    ?>
                    <tr>
                        <td><?= $socket ?></td>
                        <td><?= $start ?></td>
                        <td><?= $end ?></td>
                        <td><?= $seconds ?></td>
                        <td><?= $mbytes ?></td>
                        <td><?= $mbits_per_second ?></td>
                        <td><?= $omitted ?></td>
                        <td><?= $sender ?></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
    <?php
} else {
    echo 'Invalid JSON data or missing "intervals" section.';
}
?>
