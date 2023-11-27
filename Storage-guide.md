# step 1

in env

FILESYSTEM_DISK=public

# step 2

php artisan storage:link

# step 3

assicurarsi che tutti i form che gestiscono immagini abbiano il "enctype=multipart/form-data"

# step 4

nel controller va inserita la funzione

Storage::put()

# step 5

visualizzazione con funzione

asset()
