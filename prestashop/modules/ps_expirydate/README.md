# ps-module-expiry-date

PrestaShop module to manage product expiry dates.

## Features
- ✅ Add expiry date field to products in BackOffice
- ✅ Display expiry date column in product list (BackOffice)
- ✅ Show expiry date on product page in FrontOffice
- ✅ Nullable date field (optional)
- ✅ Date format: DD/MM/YYYY

## Structure
```
ps_expirydate/
├── ps_expirydate.php          # Main module file
├── sql/
│   ├── install.php            # Database table creation
│   └── uninstall.php          # Database table removal
├── views/
│   └── templates/
│       ├── admin/
│       │   └── product_expiry.tpl    # BackOffice field
│       └── hook/
│           └── product_expiry.tpl    # FrontOffice display
├── logo.png
└── README.md
```

## Database
Table: `ps_product_expiry_date`
- `id_product_expiry` (PK)
- `id_product` (UNIQUE)
- `expiry_date` (DATE, nullable)
- `date_add` (DATETIME)
- `date_upd` (DATETIME)

## Installation

### Method 1: Git Clone
```bash
cd /path/to/prestashop/modules/
git clone https://github.com/isamch/ps-module-expiry-date.git ps_expirydate
```

### Method 2: Manual
1. Download the module
2. Extract to `/modules/ps_expirydate/`

### Activation
1. Go to BackOffice → Modules → Module Manager
2. Search for "Product Expiry Date"
3. Click "Install"

## Usage

### BackOffice
1. Go to Catalog → Products
2. Edit any product
3. Scroll to "Expiry Date" field
4. Set the date (or leave empty)
5. Save

### FrontOffice
- If expiry date is set: displays "Expire le : DD/MM/YYYY"
- If empty: nothing is displayed

## Hooks Used
- `displayAdminProductsExtra` - Add field in product form
- `actionProductUpdate` - Save expiry date
- `actionAdminProductsListingFieldsModifier` - Add column in product list
- `displayProductAdditionalInfo` - Display on product page

## Compatibility
- PrestaShop 8.0.0+

## License
MIT
