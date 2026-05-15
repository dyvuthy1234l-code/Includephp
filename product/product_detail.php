<?php $productId = isset($_GET['id']) ? htmlspecialchars((string) $_GET['id'], ENT_QUOTES, 'UTF-8') : ''; ?>

<section class="container py-5">
    <a href="index.php?page=homepage#menu" class="btn btn-outline-brand mb-4">
        <i class="fa-solid fa-arrow-left me-1"></i> ត្រឡប់ទៅ Menu
    </a>

    <div id="detailBox" class="soft-panel p-5 text-center">
        <div class="spinner-border text-success mb-3" role="status" aria-hidden="true"></div>
        <p class="mb-0 text-secondary">កំពុងទាញព័ត៌មានលម្អិត...</p>
    </div>
</section>

<script>
const DETAIL_API_URL = 'https://dyvuthy1234l-code.github.io/ApiFood/food.json';
const DETAIL_ID = '<?php echo $productId; ?>';
const DETAIL_FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=900&q=80';

const detailMoney = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
});

function detailPick(item, keys, fallback = '') {
    for (const key of keys) {
        if (item && item[key] !== undefined && item[key] !== null && item[key] !== '') {
            return item[key];
        }
    }
    return fallback;
}

function normalizeDetail(item, index) {
    const price = Number(detailPick(item, ['price', 'Price', 'cost', 'amount'], 0));
    return {
        id: String(detailPick(item, ['id', 'ID', '_id'], index + 1)),
        title: String(detailPick(item, ['title', 'name', 'food_name', 'foodName', 'Name'], 'មុខម្ហូប')),
        description: String(detailPick(item, ['description', 'desc', 'detail', 'details'], 'មុខម្ហូបឆ្ងាញ់សម្រាប់ជ្រើសរើស។')),
        image: String(detailPick(item, ['image', 'img', 'photo', 'thumbnail', 'url'], DETAIL_FALLBACK_IMAGE)),
        category: String(detailPick(item, ['category', 'type', 'kind'], 'Food')),
        price: Number.isFinite(price) ? price : 0
    };
}

function detailEscape(value) {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

async function loadProductDetail() {
    const detailBox = document.getElementById('detailBox');

    try {
        const response = await fetch(DETAIL_API_URL);
        if (!response.ok) {
            throw new Error('API request failed');
        }

        const data = await response.json();
        const list = Array.isArray(data) ? data : (data.foods || data.products || data.data || []);
        const products = list.map(normalizeDetail);
        const product = products.find((item) => item.id === DETAIL_ID) || products[0];

        if (!product) {
            detailBox.innerHTML = `
                <i class="fa-regular fa-face-frown fs-1 text-secondary"></i>
                <h4 class="mt-3">រកមុខម្ហូបមិនឃើញ</h4>
            `;
            return;
        }

        detailBox.className = 'soft-panel overflow-hidden';
        detailBox.innerHTML = `
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-6">
                    <img src="${detailEscape(product.image)}" class="w-100 h-100" style="min-height: 360px; object-fit: cover;" alt="${detailEscape(product.title)}" onerror="this.src='${DETAIL_FALLBACK_IMAGE}'">
                </div>
                <div class="col-lg-6 p-4 p-lg-5 text-start">
                    <span class="category-pill">${detailEscape(product.category)}</span>
                    <h1 class="section-title mt-3 mb-3">${detailEscape(product.title)}</h1>
                    <div class="price fs-2 mb-4">${detailMoney.format(product.price)}</div>
                    <p class="text-secondary fs-5">${detailEscape(product.description)}</p>
                    <hr class="my-4">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-brand px-4" type="button"><i class="fa-solid fa-cart-plus me-1"></i> ដាក់ក្នុងកន្ត្រក</button>
                        <a href="index.php?page=contact" class="btn btn-outline-brand px-4">ទាក់ទងកម្មង់</a>
                    </div>
                </div>
            </div>
        `;
    } catch (error) {
        detailBox.innerHTML = `
            <i class="fa-solid fa-circle-exclamation fs-1 text-danger"></i>
            <h4 class="mt-3">មិនអាចទាញព័ត៌មានបានទេ</h4>
            <p class="text-secondary mb-0">សូមពិនិត្យ API ឬ Internet connection របស់អ្នក។</p>
        `;
    }
}

loadProductDetail();
</script>
