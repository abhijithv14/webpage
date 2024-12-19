def get_permutation():
    user_input = input("Enter the permutation (space-separated, e.g., '1 2 3 4 5'): ")
    return list(map(int, user_input.split()))

def calculate_m_and_c(permutation):
    n = len(permutation)
    M = 0
    cycles = [False] * n
    cycle_count = 0

    # Count misplaced elements and cycles
    for i in range(n):
        if permutation[i] != i + 1:
            M += 1
            if not cycles[i]:
                cycle_count += 1
                j = i
                while not cycles[j]:
                    cycles[j] = True
                    j = permutation[j] - 1

    return M + cycle_count

def display_swap_pairs(permutation, total_swaps):
    swaps = []
    n = len(permutation)
    performed_swaps = 0  # Track the number of swaps made

    # Swap function targeting direct placement with central node (index 0)
    def swap_with_central(index):
        swaps.append((permutation[0], permutation[index]))
        permutation[0], permutation[index] = permutation[index], permutation[0]

    for i in range(1, n):
        while permutation[i] != i + 1 and performed_swaps < total_swaps:
            swap_with_central(i)
            performed_swaps += 1

            # Ensure direct placement if central node is out of place
            if permutation[0] != 1 and performed_swaps < total_swaps:
                target_index = permutation[0] - 1
                swap_with_central(target_index)
                performed_swaps += 1

    # Output the swap pairs
    for swap in swaps:
        print(swap)

# Example usage
permutation = get_permutation()
total_swaps = calculate_m_and_c(permutation)
display_swap_pairs(permutation, total_swaps)
