# TemplatePagename Plugin for DokuWiki (ammelab)

Plugin to set the prefix of templates in dokuwiki. 

The plugin default prefixes are:
 * `c_` : Templates for current namespace
 * `i_` : Templates for namespace one level below
 * `ii_`: Templates for namespace any level below

Following the prefix you may use any name, or the default `template` name.

## Template search order

 * Searching begins in current namespace, working back to the root namespace until a match is found. 
 * When searching for a template, templates of the same name are considered before the generic `template` name.

### Example

Say a template exists `:foo:bar:i_sidebar`, and a new page is created `:foo:bar:baz:sidebar`.

The following searches will take place loading the new page editor:

 * `:foo:bar:baz:c_sidebar`
 * `:foo:bar:baz:c_template`
 * `:foo:bar:baz:i_sidebar`
 * `:foo:bar:baz:i_template`
 * `:foo:bar:baz:ii_sidebar`
 * `:foo:bar:baz:ii_template`
 * `:foo:bar:i_sidebar` (match) -> returns template to editor
 * `:foo:bar:i_template`
 * `:foo:bar:ii_sidebar`
 * `:foo:bar:ii_template`
 * `:foo:ii_sidebar`
 * `:foo:ii_template`
 * `:ii_sidebar`
 * `:ii_template`



Be aware, when the template name starts with characters like `_` it is not 
editable online in the wiki, only by server admins via the file system.
When you follow the [page name conventions](https://www.dokuwiki.org/pagename) people who has write permission on it
may modify the page.


All documentation for this plugin can be found at
https://www.dokuwiki.org/plugin:templatepagename

If you install this plugin manually, make sure it is installed in
`lib/plugins/templatepagename/` - if the folder is called different it
will not work!

Please refer to https://www.dokuwiki.org/plugins for additional info
on how to install plugins in DokuWiki.

----
Copyright (C) Martin <martin@sound4.biz>
Copyright (C) Ben <ben.vanmagill16@gmail.com>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

See the COPYING file in your DokuWiki folder for details
