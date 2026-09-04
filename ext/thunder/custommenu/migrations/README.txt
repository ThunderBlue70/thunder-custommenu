# Thunder Custom Menu 1.0.0

Configurable and responsive menu system for phpBB 3.3.x.

Thunder Custom Menu adds a fully configurable navigation bar to phpBB, with support for main menu entries, dropdown menus, nested submenus, internal and external links, Font Awesome icons, Quick Links integration and optional integration of the forum search.

The extension is designed to be configured entirely from the phpBB Administration Control Panel without modifying phpBB core files.

---

## FEATURES

## Main menu

* Create and manage custom main menu entries.
* Create simple links or dropdown menus.
* Reorder main menu entries using the Up and Down controls.
* Remove complete menu entries directly from the menu card.
* Newly created entries are added at the top of the menu.
* Configurable menu width and height.
* Optional integrated position below the phpBB header.
* Optional separate position below the header.

## Dropdown menus

* Create dropdown menus containing multiple links.
* Reorder links inside each dropdown menu.
* Individual links can be removed without deleting the complete menu.
* Dropdown menus use independent background, hover and text colours.
* Dropdown entries use a compact separated-rectangle design.

## Submenus

* Create a submenu from an existing menu link.
* Submenus can contain their own links.
* Submenus open laterally from their parent entry.
* Multiple submenu levels are supported.
* Submenus can therefore be nested into further submenus.
* Each submenu can be independently ordered and edited.

## Links

Custom links can point to:

* Internal phpBB pages.
* Relative paths.
* Parent-directory paths.
* Standard phpBB paths such as index.php.
* External HTTPS addresses.

Examples of supported URL formats include:

```
https://example.com/
./viewforum.php
../index.php
index.php
```

Links can also be configured to open:

* In the same browser tab.
* In a new browser tab.

## Font Awesome icons

Menu links can use Font Awesome icons.

The ACP provides a dedicated button to help select or enter Font Awesome icons for menu entries.

## Menu and link management

The ACP menu editor provides:

* Create Link.
* Create Dropdown Menu.
* Create Submenu.
* Move entries Up.
* Move entries Down.
* Delete individual links.
* Delete complete top-level menu entries.
* Edit menu and link properties.

The editor is designed to keep the menu structure visible while it is being configured.

## Quick Links

Thunder Custom Menu can optionally integrate phpBB's native Quick Links into the custom menu.

When enabled:

* Quick Links are generated using phpBB's existing permission system.
* Users only see Quick Links they are allowed to access.
* Guest permissions are respected.
* If no Quick Links are available to the current user, the generated Quick Links entry is hidden.
* The generated Quick Links menu is locked in the ACP and cannot be manually edited or deleted.
* Disabling the Quick Links option removes the generated Quick Links menu.

This integration does not replace phpBB's permission system.

## Search

The native phpBB search can optionally be moved into the custom menu bar.

When enabled, the search field is displayed on the right side of the custom menu while retaining its normal phpBB search functionality.

The search field remains positioned independently from the menu entries when the menu wraps onto multiple lines.

## Forum Index

The native phpBB forum Index/Home navigation element can optionally be hidden.

This allows the custom menu to provide the preferred Home/Index navigation while normal forum navigation remains available.

The option can be enabled or disabled from the ACP.

## Responsive behaviour

The menu is designed to accommodate multiple menu entries.

When the available horizontal space is insufficient, menu entries can wrap onto additional lines while the search area remains positioned independently.

---

## COLOUR CUSTOMIZATION

The ACP provides separate colour settings for the main menu and dropdown menus.

Main menu colours:

* Main menu background.
* Main menu hover background.
* Main menu text.

Dropdown colours:

* Dropdown background.
* Dropdown hover background.
* Dropdown text.

Colours are configured individually using the native colour selection controls provided by the ACP.

---

## MENU POSITION AND SIZE

The menu can be configured in two positions:

## Integrated

The menu is integrated with the phpBB header area.

The integrated layout includes rounded lower corners and is designed to appear as part of the header/navigation area.

## Separate

The menu is displayed separately below the phpBB header.

The following dimensions can be configured:

* Menu width.
* Menu height.

---

## ADMINISTRATION

All Thunder Custom Menu settings are managed from the phpBB Administration Control Panel.

The configuration includes:

* Enable or disable the menu.
* Integrated or separate menu position.
* Menu width.
* Menu height.
* Show or hide the search field in the menu.
* Show or hide Quick Links in the menu.
* Show or hide the original phpBB forum Index/Home element.
* Main menu colours.
* Dropdown colours.
* Menu and dropdown entries.
* Submenus and nested submenus.
* Link URLs.
* Link targets.
* Font Awesome icons.
* Menu ordering.

---

## INSTALLATION

1. Download the Thunder Custom Menu extension package.

2. Extract the extension into the phpBB extensions directory so that the following structure is preserved:

   ext/thunder/custommenu/

3. Open the phpBB Administration Control Panel.

4. Go to:

   Customise
   Extensions

5. Locate:

   Thunder Custom Menu

6. Click Enable.

The extension does not require modifications to phpBB core files.

---

## CONFIGURATION

After enabling the extension:

1. Open the Thunder Custom Menu configuration page in the ACP.
2. Enable the menu.
3. Select the desired menu position.
4. Configure the width and height.
5. Select whether Search and Quick Links should be displayed in the menu.
6. Select whether the original forum Index/Home element should be hidden.
7. Configure the menu and dropdown colours.
8. Create the required links and dropdown menus.
9. Add submenus where required.
10. Arrange the entries using the Up and Down controls.
11. Save the configuration.

---

## UNINSTALLATION

The extension can be disabled or removed through the standard phpBB Extension Manager.

Before uninstalling, disable Thunder Custom Menu from:

```
ACP
Customise
Extensions
```

The extension is designed to use phpBB's extension and migration system rather than requiring manual modifications to phpBB core files.

---

## REQUIREMENTS

phpBB:

```
3.3.x
Supported range: 3.3.0 to below 3.4.0
```

PHP:

```
PHP 7.2 or newer
```

The extension is intended for phpBB 3.3.x installations.

---

## COMPATIBILITY

Thunder Custom Menu is developed for phpBB 3.3.x.

The extension uses phpBB's extension system and does not require modifications to phpBB core files.

---

## NOTES

Thunder Custom Menu is configured through the phpBB Administration Control Panel.

Menu entries created by the administrator are stored by the extension and can be modified without editing template, CSS or PHP files manually.

The Quick Links integration uses phpBB's existing permissions and therefore adapts the available links to the current user's permissions.

External links should normally use HTTPS where available.

---

## AUTHOR

ThunderBlue

Thunder Custom Menu
Version 1.0.0

---

## LICENSE

Thunder Custom Menu is released under the GNU General Public License version 2.0 (GPL-2.0-only).

