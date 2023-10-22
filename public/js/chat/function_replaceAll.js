function replaceAll(string, replacements) {
    for (const key in replacements) {
        if (replacements.hasOwnProperty(key)) {
            string = string.replace(new RegExp('{' + key + '}', 'g'), replacements[key]);
        }
    }
    return string;
}
