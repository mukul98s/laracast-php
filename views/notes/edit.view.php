<?php require base_path('views/partials/head.php') ?>
<?php require base_path("views/partials/nav.php") ?>
<?php require base_path("views/partials/banner.php") ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-8">
            <a href="/notes" class="text-blue-500 underline">Go Back</a>
        </p>

        <form method="POST" action="/note">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <div class="pb-12">
               <div class="col-span-full">
                  <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                  <div class="mt-2">
                    <textarea 
                        id="body" 
                        name="body" 
                        rows="5" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $note['note'] ?? '' ?> </textarea>
                        <?php if(isset($errors['body'])) : ?>
                            <p class="text-sm text-red-500 mt-1"><?= $errors['body'] ?></p>
                        <?php endif; ?>
                  </div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 justify-end">
                <a href="/note?id=<?= $note['id'] ?>" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save Note</button>
            </div>
        </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
