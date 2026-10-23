const alphabet = '0123456789ABCDEFGHJKMNPQRSTVWXYZ'

/**
 * Generates a ULID, so a new block has its final id before it is saved.
 */
export function ulid(): string {
    let time = Date.now()
    let timePart = ''

    for (let index = 0; index < 10; index++) {
        timePart = alphabet[time % 32] + timePart
        time = Math.floor(time / 32)
    }

    const randomBytes = crypto.getRandomValues(new Uint8Array(16))
    const randomPart = Array.from(randomBytes, (byte) => alphabet[byte % 32]).join('')

    return timePart + randomPart
}
