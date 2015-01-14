/**
 * For array sort by user id
 *
 * @param a
 * @param b
 * @returns {number}
 */
var byId = function (a, b) {
    if (parseInt(a.id) < parseInt(b.id))
        return -1;
    if (parseInt(a.id) > parseInt(b.id))
        return 1;
    return 0;
};