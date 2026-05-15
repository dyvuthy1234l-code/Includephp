<section id="menu" class="container py-5">
    <div class="row align-items-end g-3 mb-4">
        <div class="col-lg-6">
            <span class="category-pill">Menu Collection</span>
            <h2 class="section-title mt-3 mb-2">មុខម្ហូបពេញនិយម</h2>
            <p class="text-secondary mb-0">ទិន្នន័យត្រូវបានទាញពី API ហើយបង្ហាញជា Bootstrap cards ងាយមើល។</p>
        </div>
        <div class="col-lg-6">
            <div class="soft-panel p-3">
                <div class="row g-2">
                    <div class="col-md-7">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-secondary"></i></span>
                            <input type="search" id="searchInput" class="form-control border-start-0" placeholder="ស្វែងរកមុខម្ហូប...">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select id="sortSelect" class="form-select">
                            <option value="default">តម្រៀបធម្មតា</option>
                            <option value="price-asc">តម្លៃទាបទៅខ្ពស់</option>
                            <option value="price-desc">តម្លៃខ្ពស់ទៅទាប</option>
                            <option value="name-asc">ឈ្មោះ A-Z</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../product/product_card.php'; ?>
</section>
