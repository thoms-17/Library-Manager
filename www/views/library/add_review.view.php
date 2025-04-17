<div class="container mt-5">
    <h1 class="mb-4">Ajouter un Avis</h1>

    <form action="/library/book/<?= $bookId ?>/add-review" method="POST">
        <div class="form-group">
            <label for="content">Votre avis :</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="rating">Note :</label>
            <div id="star-rating" class="mb-2">
                <i class="far fa-star star" data-value="1"></i>
                <i class="far fa-star star" data-value="2"></i>
                <i class="far fa-star star" data-value="3"></i>
                <i class="far fa-star star" data-value="4"></i>
                <i class="far fa-star star" data-value="5"></i>
            </div>

            <input type="hidden" name="rating" id="rating" required>
        </div>

        <button type="submit" class="btn btn-success">Poster l'avis</button>
    </form>
</div>

<style>
    #star-rating .star {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
    }

    #star-rating .star.hover,
    #star-rating .star.selected {
        color: gold;
    }
</style>