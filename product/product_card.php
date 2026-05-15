<div id="statusBox" class="soft-panel p-5 text-center">
    <div class="spinner-border text-success mb-3" role="status" aria-hidden="true"></div>
    <p class="mb-0 text-secondary">កំពុងទាញយកមុខម្ហូប...</p>
</div>

<div id="productsContainer" class="row g-4"></div>

<script>
const API_URL = 'https://dyvuthy1234l-code.github.io/ApiFood/food.json';
const FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=900&q=80';

let allProducts = [];

const money = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
});

function pick(item, keys, fallback = '') {
    for (const key of keys) {
        if (item && item[key] !== undefined && item[key] !== null && item[key] !== '') {
            return item[key];
        }
    }
    return fallback;
}

function normalizeProduct(item, index) {
    const price = Number(pick(item, ['price', 'Price', 'cost', 'amount'], 0));
    return {
        id: String(pick(item, ['id', 'ID', '_id'], index + 1)),
        title: String(pick(item, ['title', 'name', 'food_name', 'foodName', 'Name'], 'មុខម្ហូប')),
        description: String(pick(item, ['description', 'desc', 'detail', 'details'], 'មុខម្ហូបឆ្ងាញ់សម្រាប់ជ្រើសរើស។')),
        image: String(pick(item, ['image', 'img', 'photo', 'thumbnail', 'url'], FALLBACK_IMAGE)),
        category: String(pick(item, ['category', 'type', 'kind'], 'Food')),
        price: Number.isFinite(price) ? price : 0
    };
}

function escapeHtml(value) {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function shortText(text, limit = 86) {
    return text.length > limit ? `${text.slice(0, limit).trim()}...` : text;
}

function renderProducts(items) {
    const statusBox = document.getElementById('statusBox');
    const container = document.getElementById('productsContainer');
    statusBox.classList.add('d-none');

    if (!items.length) {
        container.innerHTML = `
            <div class="col-12">
                <div class="soft-panel p-5 text-center">
                    <i class="fa-regular fa-face-frown fs-1 text-secondary"></i>
                    <h5 class="mt-3">រកមុខម្ហូបមិនឃើញ</h5>
                    <p class="text-secondary mb-0">សាកល្បងស្វែងរកពាក្យផ្សេងទៀត។</p>
                </div>
            </div>
        `;
        return;
    }

    container.innerHTML = items.map((product) => `
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <article class="card product-card h-100 bg-white">
                <img src="${escapeHtml(product.image)}" class="card-img-top" alt="${escapeHtml(product.title)}" loading="lazy" onerror="this.src='${FALLBACK_IMAGE}'">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                        <span class="category-pill">${escapeHtml(product.category)}</span>
                        <span class="price">${money.format(product.price)}</span>
                    </div>
                    <h5 class="card-title fw-bold">${escapeHtml(product.title)}</h5>
                    <p class="card-text text-secondary small flex-grow-1">${escapeHtml(shortText(product.description))}</p>
                    <a href="index.php?page=detail&id=${encodeURIComponent(product.id)}" class="btn btn-outline-brand w-100 mt-2">
                        <i class="fa-regular fa-eye me-1"></i> មើលលម្អិត
                    </a>
                </div>
            </article>
        </div>
    `).join('');
}

function applyFilters() {
    const keyword = document.getElementById('searchInput').value.trim().toLowerCase();
    const sort = document.getElementById('sortSelect').value;
    let items = allProducts.filter((product) => {
        const haystack = `${product.title} ${product.description} ${product.category}`.toLowerCase();
        return haystack.includes(keyword);
    });

    if (sort === 'price-asc') {
        items.sort((a, b) => a.price - b.price);
    } else if (sort === 'price-desc') {
        items.sort((a, b) => b.price - a.price);
    } else if (sort === 'name-asc') {
        items.sort((a, b) => a.title.localeCompare(b.title));
    }

    renderProducts(items);
}

async function fetchProducts() {
    try {
        const response = await fetch(API_URL);
        if (!response.ok) {
            throw new Error('API request failed');
        }

        const data = await response.json();
        const list = Array.isArray(data) ? data : (data.foods || data.products || data.data || []);
        allProducts = list.map(normalizeProduct);
        renderProducts(allProducts);
    } catch (error) {
        document.getElementById('statusBox').innerHTML = `
            <i class="fa-solid fa-circle-exclamation fs-1 text-danger"></i>
            <h5 class="mt-3">មិនអាចទាញទិន្នន័យបានទេ</h5>
            <p class="text-secondary mb-0">សូមពិនិត្យ API ឬ Internet connection របស់អ្នក។</p>
        `;
    }
}

document.getElementById('searchInput').addEventListener('input', applyFilters);
document.getElementById('sortSelect').addEventListener('change', applyFilters);
fetchProducts();
</script>
