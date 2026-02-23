# Nutri Hummingbird - Child Theme

## Description
Child theme of Hummingbird for Nutriweb PrestaShop project.

## Structure
```
nutrihummingbird/
├── config/
│   └── theme.yml              # Theme configuration with parent reference
├── assets/
│   └── css/
│       └── custom.css         # Custom CSS modifications
├── templates/
│   ├── catalog/
│   │   └── product.tpl        # Modified product page with delivery info
│   └── _partials/
│       └── header.tpl         # Modified header
└── preview.png                # Theme preview image
```

## Modifications

### 1. CSS Customizations (custom.css)
- Custom color scheme
- Product delivery info block styling
- Product expiry date styling
- Header customizations
- Button styling
- Responsive adjustments

### 2. Template Files Modified

#### product.tpl
- Added delivery information block after product description
- Displays shipping info: "Livraison gratuite à partir de 500 DH"

#### header.tpl
- Added custom class to header-top for styling

## Installation

1. Copy theme to `/themes/nutrihummingbird/`
2. Go to BackOffice → Design → Theme & Logo
3. Select "Nutri Hummingbird" theme
4. Click "Use this theme"
5. Clear cache

## Parent Theme
This theme extends: **Hummingbird**

All non-overridden files are inherited from parent theme.
