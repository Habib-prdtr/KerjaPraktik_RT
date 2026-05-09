import os
import glob

views_dir = r"c:\Aplikasi\laragon\www\kp_rt\resources\views\warga"

for filepath in glob.glob(os.path.join(views_dir, "**", "*.blade.php"), recursive=True):
    with open(filepath, "r", encoding="utf-8") as f:
        content = f.read()
    
    # Change it back to layouts.warga
    new_content = content.replace("@extends('layouts.app')", "@extends('layouts.warga')")

    if new_content != content:
        with open(filepath, "w", encoding="utf-8") as f:
            f.write(new_content)
        print(f"Updated {filepath}")
