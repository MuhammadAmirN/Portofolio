import json

with open('repos_latest.json', 'r', encoding='utf-8') as f:
    repos = json.load(f)

print(f"Total repositories: {len(repos)}\n")
print(f"{'#':<3} {'Name':<55} {'Language':<15} {'Stars':<6} {'Forks':<6} {'Updated':<12} {'Description'}")
print("-" * 160)

for i, r in enumerate(repos, 1):
    name = r.get('name', 'N/A')
    lang = r.get('language', 'N/A') or 'N/A'
    stars = r.get('stargazers_count', 0)
    forks = r.get('forks_count', 0)
    updated = r.get('updated_at', '')[:10]
    desc = (r.get('description') or 'No description')[:80]
    fork = '[FORK]' if r.get('fork') else ''
    print(f"{i:<3} {name:<55} {lang:<15} {stars:<6} {forks:<6} {updated:<12} {desc} {fork}")
