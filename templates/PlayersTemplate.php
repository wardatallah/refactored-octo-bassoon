<div>
    <span class="title">Current Players</span>
    <ul>
        <?php foreach($players as $player) { ?>
            <li>
                <div>
                    <span class="player-name">Name: <?= $player->name ?></span>
                    <span class="player-age">Age: <?= $player->age ?></span>
                    <span class="player-salary">Salary: <?= $player->salary ?></span>
                    <span class="player-job">Job: <?= $player->job ?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>