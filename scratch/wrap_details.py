import os
import glob

views_dir = r"c:\Aplikasi\laragon\www\kp_rt\resources\views\warga"
files_to_modify = [
    "surat/create.blade.php",
    "surat/show.blade.php",
    "pengaduan/create.blade.php",
    "pengaduan/show.blade.php",
    "pengumuman/show.blade.php",
    "kegiatan/show.blade.php"
]

for filename in files_to_modify:
    filepath = os.path.join(views_dir, filename)
    if os.path.exists(filepath):
        with open(filepath, "r", encoding="utf-8") as f:
            content = f.read()
        
        # We look for `@section('content')\n<div>`
        content = content.replace("@section('content')\n<div>", "@section('content')\n<div class=\"max-w-3xl mx-auto space-y-6\">")
        content = content.replace("@section('content')\r\n<div>", "@section('content')\r\n<div class=\"max-w-3xl mx-auto space-y-6\">")
        
        # Just in case some have `space-y-X` already on that div
        if 'max-w-3xl mx-auto' not in content:
            # Let's do a more robust replace using regex
            import re
            content = re.sub(r"@section\('content'\)\s*<div\b", r"@section('content')\n<div class=\"max-w-3xl mx-auto\" ", content)
            # Remove empty class="" if it resulted
            content = content.replace(' class="max-w-3xl mx-auto"  class="', ' class="max-w-3xl mx-auto ')

        with open(filepath, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"Updated {filepath}")
