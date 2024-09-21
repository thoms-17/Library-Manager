<div class="container">
    <h1>Tableau Kanban</h1>
    <div class="kanban-board">
        <div class="kanban-column">
            <h3>À faire</h3>
            <div class="kanban-items" id="to_do_items">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'to_do') : ?>
                        <div class="kanban-item"><?= $task['title'] ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Similar divs for "in_progress" and "done" tasks -->
    </div>
</div>

<script src="/js/kanban.js"></script>